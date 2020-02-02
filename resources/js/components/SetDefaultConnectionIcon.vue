<template>
    <div class="text-center">
        <i v-if="selected" class="fa fa-check fs-3"></i>
        <span v-if="!selected" class="pointer" @click="makeDefault"
            >Select</span
        >
    </div>
</template>

<script>
export default {
    props: {
        id: {
            type: String,
            required: true,
        },
        selected: {
            type: Boolean,
            required: true,
        },
    },

    mounted() {},

    methods: {
        makeDefault() {
            axios
                .post(`/connection/${this.id}/default`)
                .then(response => {
                    this.$emit('done')
                })
                .catch(error => {
                    console.error(error)
                })
        },
    },
}
</script>
