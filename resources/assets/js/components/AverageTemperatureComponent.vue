<template>
    <div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Number Visits</h6>
            </div>
            <div class="card-body">
                <line-chart xtitle="Day" ytitle="Visits" data="/average/visits"></line-chart>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Average Temperature</h6>
            </div>
            <div class="card-body">
                <line-chart xtitle="Day" ytitle="Temperature" :colors="['#b00', '#666']" data="/average/temperature"></line-chart>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AverageTemperatureComponent",
        data   : function () {
            return {
                chart_data:{}
            }
        },
        methods:{

            getChartData(){
                axios.get('/average/temperature')
                    .then(response=>{
                        console.log(response.data)
                        this.chart_data = response.data;
                    })
                    .catch(error=>{
                        console.log(error)
                    })


            }
        },
        created() {
            this.getChartData();
        }

    }
</script>

<style scoped>

</style>
