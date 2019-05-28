<template>
    <div class="row">
        <div class="col-12 mb-3" v-for="(connection, index) in connections" :key="connection.id">
            <div class="card">
                <div class="card-body d-flex justify-content-center align-items-between flex-column">
                    <div class="row">
                        <div class="col-md-1 flex-center">
                            <delete-connection-icon
                                    v-if="!connection.selected"
                                    :id="connection.id"
                                    @removed="removeConnection(index)"
                            >
                            </delete-connection-icon>
                        </div>
                        <div class="col-md-4 flex-center">
                            <h3 class="text-center">{{ connection.from }} <small>({{connection.time_to_station}})</small></h3>
                        </div>
                        <div class="col-md-2 flex-center">
                            <i class="fas fa-long-arrow-alt-right"></i>
                            <span v-if="connection.via">via {{ connection.via }}</span>
                        </div>
                        <div class="col-md-4 flex-center">
                            <h3 class="text-center">{{ connection.to }}</h3>
                        </div>

                        <div class="col-md-1 flex-center">
                            <set-default-connection-icon
                                    :id="connection.id"
                                    :selected="connection.selected"
                                    @done="setDefault"
                            >

                            </set-default-connection-icon>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                connections: [],
                error: ''
            }
        },

        components: {},

        methods: {

            getConnections() {

                axios
                    .get('/user/connections')
                    .then(response => {
                        this.connections = response.data
                    })
                    .catch(error => {
                        this.error = error.response.data.message
                    })

            },

            removeConnection(index) {
                this.getConnections();
            },

            setDefault() {
                window.location.reload()
            }

        },

        mounted() {
            this.getConnections()
        }
    }
</script>
