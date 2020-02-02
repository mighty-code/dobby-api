<template>
    <form @submit.prevent="create()">
        <div class="row">
            <div class="col-md-5">
                <search-station-input
                    placeholder="From"
                    @selected="station"
                ></search-station-input>
            </div>
            <div class="col-md-2">
                <div
                    class="form-group flex-center pointer"
                    @click="showVia = !showVia"
                >
                    <span v-if="connection.via">via</span>
                    <i class="fa fa-long-arrow-alt-right fa-2x"></i>
                </div>
            </div>
            <div class="col-md-5">
                <search-station-input
                    placeholder="To"
                    @selected="destination"
                ></search-station-input>
            </div>
        </div>

        <search-station-input
            v-if="showVia"
            class="animated fadeIn"
            placeholder="via"
            @selected="via"
        ></search-station-input>

        <div class="form-group">
            <input
                v-model="connection.time_to_station"
                placeholder="Time to station (Minutes)"
                class="form-control"
                required
            />
        </div>
        <button
            type="submit"
            class="btn btn-outline-primary btn-block"
            :disabled="
                !connection.to ||
                    !connection.from ||
                    !connection.time_to_station
            "
        >
            {{ submitText }}
        </button>

        <div v-if="error" class="alert alert-danger mt-2">
            {{ error }}
        </div>
    </form>
</template>

<script>
export default {
    props: {
        onboarding: {
            type: String,
            default: () => '',
        },
        submitText: {
            type: String,
            default: () => '',
        },
    },

    data() {
        return {
            connection: {
                from: null,
                to: null,
                via: '',
                time_to_station: '',
            },
            showVia: false,
            error: '',
            stations: [],
        }
    },

    mounted() {},

    methods: {
        station(station) {
            this.connection.from = station
        },

        destination(station) {
            this.connection.to = station
        },

        via(station) {
            this.connection.via = station
        },

        async create() {
            let apiUrl =
                this.onboarding != null ? '/onboarding' : '/user/connections'
            let redirectUrl = this.onboarding != null ? '/home' : '/manage'
            try {
                await axios.post(apiUrl, this.connection)
                window.location.href = redirectUrl
            } catch (error) {
                this.error = error.response.data.message
            }
        },
    },
}
</script>
