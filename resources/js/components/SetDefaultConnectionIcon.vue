<template>
    <div class="text-center">
        <i class="fa fa-check fs-3" v-if="selected"></i>
        <span @click="makeDefault" class="pointer" v-if="!selected">Select</span>
    </div>
</template>

<script>
    export default {

        props: [
            'id',
            'selected'
        ],

        methods: {

            makeDefault() {

                axios
                    .post(`/connection/${this.id}/default`)
                    .then(response => {
                        this.$emit('done')
                    })
                    .catch(error => {
                        console.log(error)
                    })

            }

        },

        mounted() {
        }
    }
</script>
