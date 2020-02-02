<template>
    <i class="fa fa-trash fs-3 pointer" @click="remove"></i>
</template>

<script>
export default {
    props: {
        id: {
            type: Number,
            required: true,
        },
    },

    data() {
        return {
            error: '',
        }
    },

    mounted() {},

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
        },
    },
}
</script>
