<template>
    <div class="root">
        <nav-bar :is-sticky="sticky">
            <a class="navbar-brand mb-0 h1" href="#">Dumper</a>
            <template slot="left">
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </template>
            <template slot="right">
                <li class="nav-item cursor">
                    <a class="nav-link" @click="clearLogs">
                        <i class="fa fa-fw fa-lg fa-trash-o" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <toggle class="nav-link" v-model="sticky"></toggle>
                </li>
                <li class="nav-item">
                    <a class="nav-link cursor">
                        <i class="fa fa-fw fa-lg fa-cog" aria-hidden="true"></i>
                    </a>
                </li>
            </template>
        </nav-bar>

        <log-list :logs="logs"></log-list>

        <pre-loader :ready="ready">
            <i class="fa fa-refresh fa-spin fa-5x fa-fw"></i>
            <span class="sr-only">Loading..</span>
        </pre-loader>
    </div>
</template>

<script>
    import axios from "axios";
    import PreLoader from "./PreLoader";
    import MyButton from "./MyButton";
    import NavBar from "./NavBar";
    import Toggle from "./NavBar/Toggle";
    import LogList from "./LogList";

    export default {
        name: "app",
        el: "#app",
        data() {
            return {
                ts: -1,
                ready: false,
                sticky: true,
                logs: [],
            }
        },
        methods: {
            loadData() {
                axios
                    .get("?ts=" + this.ts)
                    .then(response => {
                        if (response.data.response && response.data.response.ts) {
                            this.ts = response.data.response.ts;
                            for (let index in response.data.response.data) {
                                let log = response.data.response.data[index];
                                this.logs.unshift(JSON.parse(log.data));
                            }
                        }
                    })
                    .catch(error => console.log(error))
                    .then(this.loadData)
                ;
            },
            clearLogs() {
                this.logs = [];
                axios
                    .get("?clear=1")
                ;
            },
        },
        mounted() {
            axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest'
            };

            this.loadData();
            this.ready = true;
        },
        components: {
            PreLoader,
            MyButton,
            NavBar,
            Toggle,
            LogList,
        },
    }
</script>

<style lang="stylus" scoped>
    .root {
        margin-bottom: 30px;
    }
</style>
