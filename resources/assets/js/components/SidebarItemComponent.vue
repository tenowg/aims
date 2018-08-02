<template>
    <a href="#" v-bind:class="{ closed: open  }"><i :class="icon"></i> {{text}}</a>
</template>

<script>
export default {
    props: [
        'open',
        'text',
        'icon'
    ]
}
</script>
