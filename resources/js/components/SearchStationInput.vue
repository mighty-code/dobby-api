<template>
    <div class="form-group">
        <div class="row">
            <div class="col-12">
                <input
                    ref="input"
                    v-model="query"
                    :placeholder="placeholder"
                    class="form-control"
                    autofocus
                    @keyup="search"
                />
            </div>
            <div class="col-12 d-flex flex-column align-items-center mt-2">
                <span
                    v-for="station in stations"
                    :key="station.id"
                    class="tag pointer mb-2 animated fadeIn"
                    @click="select(station)"
                >
                    {{ station.name }}
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import _ from 'lodash'

export default {
    props: {
        placeholder: {
            type: String,
            required: true,
        },
    },

    data() {
        return {
            query: '',
            error: '',
            stations: [],
        }
    },

    methods: {
        search: _.debounce(function() {
            if (this.query.length >= 2) {
                axios
                    .get('/stations/search', {
                        params: { query: this.query },
                    })
                    .then(response => {
                        this.stations = response.data
                        this.stations.splice(3)
                    })
                    .catch(error => console.error(error))
            }
        }, 250),

        select(station) {
            this.query = station.name
            this.$emit('selected', station)
            this.stations = []
            this.$refs.input.focus()
        },
    },
}
</script>
