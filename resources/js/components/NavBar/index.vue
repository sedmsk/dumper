<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" :class="{ 'sticky-top' : isSticky }">
        <div class="container">
            <slot></slot>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02" :class="{ 'show': showCollapse }">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <slot name="left"></slot>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <selector :list="tags"></selector>
                </form>
                <ul class="navbar-nav">
                    <slot name="right"></slot>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import Selector from "../Selector";

    export default {
        name: "NavBar",
        props: {
            "isSticky": {
                type: Boolean
            }
        },
        data: function () {
            return {
                showCollapse: false,
                tags: [
                    "type",
                    "user",
                ],
            };
        },
        methods: {
            toggleCollapse: function () {
                this.showCollapse = !this.showCollapse;
            }
        },
        components: {
            Selector,
        }
    }
</script>
