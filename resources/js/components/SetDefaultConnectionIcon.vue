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
            type: Number,
            required: true,
        },
        selected: {
            type: Number,
            required: true,
        },
    },

    methods: {
        async makeDefault() {
            try {
                await axios.post(`/connection/${this.id}/default`)
                this.$emit('done')
            } catch (error) {
                console.error(error)
            }
        },
    },
}
</script>
