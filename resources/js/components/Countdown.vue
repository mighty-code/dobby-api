<template>
    <div class="pt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="countdown">{{ countdown }}</h1>
            </div>
        </div>
        <div class="row frame animated bounceInDown">
            <div
                class="col-5 d-flex flex-column justify-content-center align-items-center"
            >
                <i class="fa fa-home connection-text mb-3"></i>
                <span class="connection-text">{{ connection.from }}</span>
                <span class="connection-subtext">{{ departureTime }}</span>
            </div>
            <div
                class="col-2 d-flex justify-content-center align-items-center flex-column"
            >
                <span v-if="connection.departure_platform"
                    >Platform {{ connection.departure_platform }}</span
                >
                <i class="fas fa-long-arrow-alt-right fs-5"></i>
                <span v-if="connection.arrival_platform"
                    >Platform {{ connection.arrival_platform }}</span
                >
            </div>
            <div
                class="col-5 d-flex flex-column justify-content-center align-items-center"
            >
                <i class="fa fa-map-marker-alt connection-text mb-3"></i>
                <span class="connection-text">{{ connection.to }}</span>
                <span class="connection-subtext">{{ arrivalTime }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            countdown: '',
            connection: {},
        }
    },

    computed: {
        departureTime() {
            return moment.unix(this.connection.departure).format('H:mm')
        },

        arrivalTime() {
            return moment.unix(this.connection.arrival).format('H:mm')
        },
    },

    mounted() {
        this.getNextConnection()

        setInterval(() => {
            let departure = moment.unix(this.connection.departure).utc()
            let now = moment().utc()
            let leaveIn = departure.diff(now, 'minutes')
            let leaveInHours = departure.diff(now, 'hours')
            leaveIn += leaveInHours * 60
            leaveIn = leaveIn - this.connection.time_to_station

            console.log('calculateCountdown() leaveIn:=', leaveIn)

            this.countdown = leaveIn

            if (this.countdown <= 0) this.getNextConnection()
        }, 1000)
    },

    methods: {
        async getNextConnection() {
            try {
                const { data } = await axios.get('/api/connections/next')
                this.connection = data.data
            } catch (error) {
                console.log(error)
            }
        },
    },
}
</script>
