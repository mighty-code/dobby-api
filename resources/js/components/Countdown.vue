<template>
    <div class="pt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="countdown">{{ countdown }}</h1>
            </div>
        </div>
        <div class="row frame animated bounceInDown">
            <div class="col-5 d-flex flex-column justify-content-center align-items-center">
                <i class="fa fa-home connection-text mb-3"></i>
                <span class="connection-text">{{ connection.from }}</span>
                <span class="connection-subtext">{{ departureTime }}</span>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                <span v-if="connection.departure_platform">Platform {{ connection.departure_platform }}</span>
                <i class="fas fa-long-arrow-alt-right fs-5"></i>
            </div>
            <div class="col-5 d-flex flex-column justify-content-center align-items-center">
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
                return moment(this.connection.departure).format('H:mm')
            },

            arrivalTime() {
                return moment(this.connection.arrival).format('H:mm')
            }
        },

        methods: {

            getNextConnection() {
                axios
                    .get('/connection/next')
                    .then(response => {
                        this.connection = response.data
                    })
                    .catch(error => console.log(error))
            },

        },

        mounted() {
            this.getNextConnection()

            setInterval(() => {
                let departure = moment(this.connection.departure).utc();
                let now = moment().utc();
                let leaveIn = departure.diff(now, 'minutes');
                let leaveInHours = departure.diff(now, 'hours');
                leaveIn += leaveInHours * 60;
                leaveIn = leaveIn - this.connection.time_to_station;

                console.log('calculateCountdown() leaveIn:=', leaveIn);

                this.countdown = leaveIn;

                if (this.countdown === 0)
                    this.getNextConnection();
            }, 1000);
        }

    }
</script>
