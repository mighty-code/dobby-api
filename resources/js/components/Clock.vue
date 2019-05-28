<template>
    <h3>{{ time }}</h3>
</template>

<script>
    export default {

        data() {
            return {
                time: moment().format('HH:mm')
            }
        },

        methods: {
        },

        mounted() {
            setInterval(() =>{
                this.time = moment().format('HH:mm')
            }, 1000)
        }
    }
</script>
