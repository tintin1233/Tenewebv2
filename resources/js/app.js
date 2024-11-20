import axios from "axios";
import "./bootstrap";

import Alpine from "alpinejs";
import anchor from "@alpinejs/anchor";

window.Alpine = Alpine;

Alpine.data("lineChart", () => ({
    chart: null,
    title: "Monthly Dues & Amortization Trends by Month",
    init() {
        const chartElement = this.$refs.chart;

        var options = {
            series: [
                {
                    name: "Total Collections",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148],
                },
            ],
            chart: {
                height: 350,
                type: "line",
                zoom: {
                    enabled: false,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "straight",
            },
            title: {
                text: this.title,
                align: "left",
            },
            grid: {
                row: {
                    colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                    opacity: 0.5,
                },
            },
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                ],
            },
        };

        this.chart = new ApexCharts(chartElement, options);
        this.chart.render();
    },

     updateData(newDataSeries, newTitle) {
        console.log(newDataSeries)
        const labels = Object.keys(newDataSeries);
        const values = Object.values(newDataSeries);
        console.log(labels, values);
        this.chart.updateOptions({
            series: [
                {
                    data: values,
                },
            ],
            xaxis: {
                categories: labels,
            },
            title: {
                text: newTitle,
            },
        });
     },
}));

Alpine.data("imagePreview", () => ({
    imageSrc: null,
    uploadImageHandler(e) {
        const { files } = e.target;

        const reader = new FileReader();

        reader.onload = () => {
            this.imageSrc = reader.result;
        };

        reader.readAsDataURL(files[0]);
    },
    updateSeriesData(newData) {
        const labels = newData.map((item) => Object.keys(item)[0]);
        const values = newData.map((item) => Object.values(item)[0]);
        this.chart.updateOptions({
            series: [
                {
                    data: values,
                },
            ],
            xaxis: {
                categories: labels,
            },
        });
    },
}));

Alpine.data("textEditor", () => ({
    descriptions: null,
    quillInstance: null,
    init() {
        const editor = this.$refs.editor;

        console.log("Hello world");

        this.quillInstance = new Quill(editor, {
            theme: "snow",
        });

        this.quillInstance.on("text-change", () => {
            this.descriptions = this.quillInstance.root.innerHTML;
        });
    },

    getContent() {
        const content = this.quillInstance.root.innerHTML;

        this.descriptions = content;

        console.log(this.descriptions);
    },
}));

Alpine.data("pieChart", () => ({
    chart: null,
    init() {
        const chartElement = this.$refs.chart;
        var options = {
            series: [44, 55],
            chart: {
                width: 380,
                type: "pie",
            },
            labels: ["Occupied", "Available"],
            responsive: [
                {
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200,
                        },
                        legend: {
                            position: "bottom",
                        },
                    },
                },
            ],
        };

        this.chart = new ApexCharts(chartElement, options);
        this.chart.render();
    },

    updateDataSeries(data) {
        if (data === undefined) return;
        const series = [];
        const labels = [];

        console.log(data);

        data.forEach((item) => {
            const [label, count] = Object.entries(item);

            labels.push(label[1]);
            series.push(count[1]);
        });

        this.chart.updateOptions({
            labels: labels,
        });

        this.chart.updateSeries(series);
    },
}));

Alpine.data("getRoomByTenement", () => ({
    rooms: [],
    isLoading: false,
    tenementId: null,
    init() {
        this.$watch("tenementId", () => {
            if (!this.tenementId) return;
            console.log("====================================");
            console.log("hello world");
            console.log("====================================");
            this.getRoom();
        });
    },
    async getRoom() {
        try {
            this.isLoading = true;

            const response = await axios.get(
                `/pre-register/tenement/${this.tenementId}/rooms`
            );

            this.rooms = [...response.data.rooms];
        } catch (error) {
            console.log("====================================");
            console.log(error);
            console.log("====================================");
        } finally {
            this.isLoading = false;
        }
    },
}));

Alpine.data("chatData", () => ({
    conversations: [],
    conversation: null,
    open: false,
    firstPage: null,
    lastPage: null,
    message: null,
    unreadMessages: 0,
    admins: [],
    init() {
        this.$watch("open", () => {
            if (!this.conversation) return;

            this.seenMessage();

            console.log("watch open property");
        });

        this.$watch("conversation", () => {
            if (!this.open) return;

            this.seenMessage();

            console.log("watch conversation property");
        });
    },
    async getAdminConversations() {
        const response = await axios.get("/admin/conversations");
        console.log(response.data?.conversations.data);
        this.firstPage = response?.data.first_page;
        this.lastPage = response?.data.last_page;
        this.conversations = [...response.data.conversations.data];

        if (this.conversation) {
            this.conversation = {
                ...this.conversations.find(
                    (item) => item.id === this.conversation.id
                ),
            };
        }

        this.unreadMessages = this.conversations.reduce(
            (total, conversation) => {
                return total + (conversation.unread_messages_count || 0);
            },
            0
        );

        setTimeout(() => {
            this.getAdminConversations();
        }, 2000);
    },
    async getTenantConversations() {
        const { data } = await axios.get("/tenant/conversations");
        console.log(data);
        this.conversations = [...data.conversations];
        this.admins = [...data.admins];

        if (this.conversation) {
            this.conversation = {
                ...this.conversations.find(
                    (item) => item.id === this.conversation.id
                ),
            };
        }

        this.unreadMessages = this.conversations.reduce(
            (total, conversation) => {
                return total + (conversation.unread_messages_count || 0);
            },
            0
        );

        setTimeout(() => {
            this.getTenantConversations();
        }, 2000);
    },
    async sentTenantMessage() {
        const { data } = await axios.post(
            `/tenant/conversations/${this.conversation.id}/add-message`,
            {
                message: this.message,
            }
        );
        console.log(data);

        this.message = null;
    },
    async sentAdminMessage() {
        const { data } = await axios.post(
            `/admin/conversations/${this.conversation.id}/add-message`,
            {
                message: this.message,
            }
        );

        this.message = null;
    },
    async selectConversation(conversation) {
        this.conversation = {
            ...conversation,
        };
    },
    async seenMessage() {
        const response = await axios.post(
            `/conversation/${this.conversation.id}/seen`
        );

        console.log(response.data);
    },
    async createAdminConversation(adminId) {
        try {
            const { data } = await axios.post(
                `/tenant/conversations/admin/${adminId}/create`
            );

            console.log(data);

            this.conversation = { ...data.conversation };
        } catch (error) {
            console.log(error);
        }
    },
}));

Alpine.data("tenementRooms", () => ({
    tenements: [],
    tenement: null,
    building : null,
    tenementsData(data) {
        this.tenements = [...data];

        console.log(this.tenements);
    },
    selectTenement(e) {
        let { value } = e.target;

        this.tenement = this.tenements.find((item) => item.id == value);
    },
    selectBuilding (e) {
        let { value } = e.target;
      this.building =  this.tenement.buildings.find((item) => item.id == value);
    }
}));

Alpine.data("billCreate", () => ({
    tenants: [],
    sendType: "all",
    search: null,
    tenementId: null,
    totalResult: 0,
    init() {
        this.$watch("search", () => {
            if (!this.search) return;
            this.searchTenant();
        });
    },
    getTenementId(tenementId) {
        console.log("tenement id", tenementId);
        this.tenementId = tenementId;
    },
    selectSendType(e) {
        this.sendType = e.target.value;
    },
    async searchTenant() {
        try {
            const response = await axios.get(
                `/tenement/${this.tenementId}/tenant?search=${this.search}`
            );

            this.tenants = [...response.data.tenants];
            this.totalResult = response.data.total_result;
        } catch (error) {
            console.log(error);
        }
    },
}));

Alpine.data("mediaPreview", () => ({
    mediaData: {
        src: null,
        format: null,
    },
    uploadMediaHandler(e) {
        const { files } = e.target;

        console.log(files);
        const reader = new FileReader();

        reader.onload = () => {
            this.mediaData = {
                src: reader.result,
                format: files[0].type.split("/")[0],
            };
        };

        reader.readAsDataURL(files[0]);
    },
}));

Alpine.plugin(anchor);

Alpine.start();
