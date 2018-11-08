<template>
    <div class="card-header container">
        <div class="row" v-for="(item, $index) in list" v-if="!$index || showBacktrace">
            <div class="col-sm-7 text-truncate" :title="item.file + ':' + item.line">
                <a v-if="pattern" :href="link(item)">{{ item.file + ':' + item.line }}</a>
                <span v-else>{{ item.file + ':' + item.line }}</span>
            </div>
            <div class="col-sm-4 text-truncate" :title="method(item)">
                {{ method(item) }}
            </div>
            <div class="col-sm-1 text-right">
                <i class="fa fa-fw" :class="[ { [ showBacktraceIcon ] : !$index } ]" @click="toggleBacktraceIcon"></i>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Backtrace",
        props: {
            list: {
                required: true,
            },
        },
        data() {
            return {
                pattern: "http://localhost:63342/api/file?file=/Users/Shared/Projects/SEDv1-MSK%f&line=%l",
                showBacktrace: false,
            };
        },
        methods: {
            link(item) {
                return this.pattern
                    .replace("%f", item.file.replace(/(?:\/[^\/]+){3}(.*)/, "$1"))
                    .replace("%l", item.line);
            },
            method(item) {
                return (item.class || "") + (item.type || "") + (item.function || "") + "()";
            },
            toggleBacktraceIcon() {
                this.showBacktrace = !this.showBacktrace;
            },
        },
        computed: {
            showBacktraceIcon() {
                return this.showBacktrace ? "fa-minus" : "fa-plus";
            },
        },
    }
</script>

<style lang="stylus" scoped>
    $size = 12px;

    .card-header.container {
        font: $size "Fira Code", Monaco, Consolas, monospace;
        padding: $size 15px;

        .row {
            &:not(:first-child) {
                padding-top: $size;
            }
            &:not(:last-child) {
                border-bottom: 1px solid rgba(0,0,0,.125);
                padding-bottom: $size;
            }
        }
    }
</style>
