<template>
    <v-container grid-list-xs>
        <v-card>
            <v-card-title primary-title>
                سلة الخير
            </v-card-title>
            <v-card>
                <v-text-field
                placeholder="المبلع المطلوب للسلة"
                label="تم اتمام من هذه السلة"
                v-model="goodsbasket.complete"
                ></v-text-field>
                <v-text-field
                placeholder="المبلع المطلوب للسلة"
                label="عدد السلات التي تم تجهيزها"
                v-model="goodsbasket.qty"
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
                goodsbasket:{
                    amount:0,
                    complete:0,
                    qty:0
                }
            }
        },
        created() {
            let vm = this;
            axios.get('goodsbasket/get').then(res => {
                vm.goodsbasket = res.data

        }).catch(err => {
                console.log(err)
            });
        },
        methods:{
            save() {
                let vm = this;

                axios.post('goodsbasket/set',vm.goodsbasket).then(res => {
                    alert('update success');
                }).catch(err => {console.log(err)});
            }
        }
    }
</script>