<template>
    <div id="aims-sidebar" class="sidebar" v-bind:class="{ closed: open  }">
        <a href="javascript:void(0)" class="closebtn" @click="toggleNav"><i class="fas fa-bars"></i></a>
        <aims-sidebar-item v-bind:open="open" icon="far fa-question-circle" text="About"></aims-sidebar-item>
        <aims-sidebar-item v-bind:open="open" icon="fas fa-stethoscope" text="Services"></aims-sidebar-item>
        <aims-sidebar-item v-bind:open="open" icon="far fa-user" text="Client"></aims-sidebar-item>
        <aims-sidebar-item v-bind:open="open" icon="far fa-comments" text="Contact"></aims-sidebar-item>
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

