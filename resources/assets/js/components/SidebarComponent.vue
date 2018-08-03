<template>
    <div id="aims-sidebar" class="sidebar" v-bind:class="{ closed: open  }">
        <a href="javascript:void(0)" class="closebtn" @click="toggleNav"><i class="fas fa-bars"></i></a>
        <aims-sidebar-item v-bind:open="open" icon="fas fa-chart-line" text="For Sale" href="/store/items"></aims-sidebar-item>
        <aims-sidebar-item v-bind:open="open" icon="far fa-user" text="Sell Items" href="/store/newitem"></aims-sidebar-item>
        <aims-sidebar-item v-bind:open="open" icon="far fa-comments" text="Contact"></aims-sidebar-item>
        <aims-sidebar-item v-bind:open="open" icon="far fa-question-circle" text="About" href="/about"></aims-sidebar-item>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            open: true
        }
    },
    methods:{
        toggleNav: function(event) {
            this.open = !this.open;
        }
    }
}
</script>

