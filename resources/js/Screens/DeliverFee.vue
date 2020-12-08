<template>
    <v-container grid-list-xs>
        <v-card>
            <v-card-title primary-title>
                التوصيل
            </v-card-title>
            <v-card>
                <v-text-field
                placeholder="سعر التوصيل"
                label="سعر التوصيل"
                v-model="deliverfee.fee"
                ></v-text-field>
                <v-btn color="success" @click="save">Save</v-btn>
            </v-card>
        </v-card>
    </v-container>
</template>
<script>
    export default {
        data() {
            return {
                deliverfee:{
                    fee:0
                }
            }
        },
        created() {
            let vm = this;
            axios.get('deliverfee/get').then(res => {
                vm.deliverfee = res.data

        }).catch(err => {
                console.log(err)
            });
        },
        methods:{
            save() {
                let vm = this;

                axios.post('deliverfee/set',vm.deliverfee).then(res => {
                    alert('update success');
                }).catch(err => {console.log(err)});
            }
        }
    }
</script>