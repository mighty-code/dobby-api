<template>
    <i @click="remove" class="fa fa-trash fs-3 pointer" ></i>
</template>

<script>
    export default {

        data() {
            return {
                error: ''
            }
        },

        props: [
            'id',
        ],

        methods: {
            remove() {
                axios
                    .delete(`/user/connection/${this.id}`)
                    .then(response => {
                        this.$emit('removed')
                    })
                    .catch(error => {
                        this.error = error.response.data.message
                        console.log(this.error)
                    })
            }
        },

        mounted() {
        }
    }
</script>
