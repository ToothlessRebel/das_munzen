<template>
    <div>
        <div class="text-6xl pb-4">
            Do you want to make some change?
        </div>
        <div class="text-2xl">
            <div>
                <label>
                    How much have you got? (In USD)
                    <input type="number" step="0.01" min="0" name="value" class="rounded-2xl" v-model="total"/>
                </label>
                <button class="rounded-2xl bg-green-600 border-green-600 text-white p-3" @click="convert">Cha-ching!
                </button>
            </div>
            <div v-if="errors !== undefined" class="error text-red-600">
                <div class="error" v-for="error in Object.entries(errors)">
                    <div v-for="message in error[1]">{{message}}</div>
                </div>
            </div>
            <coinage v-if="coins !== undefined" :coins="coins"/>
        </div>
    </div>
</template>

<script>
import Coinage from "./Coinage";

export default {
    name: "Conversion",
    components: {Coinage},
    data() {
        return {
            total: null,
            errors: undefined,
            coins: undefined,
        }
    },
    methods: {
        convert() {
            axios.get('/api/convert/USD?value=' + this.total)
                .then(response => this.coins = response.data)
                .catch(error => {
                    this.errors = error.response.data.errors
                })
        },
    },
}
</script>

<style scoped>

</style>
