<template>
    <div>
        <div class="text-6xl pb-4">
            Do you want to make some change?
        </div>
        <div class="text-2xl">
            <div>
                <label>
                    How much have you got?
                    <input type="number" step="0.01" min="0" name="value" class="rounded-2xl" v-model="total"/>
                </label>
                <button class="rounded-2xl bg-green-600 border-green-600 text-white p-3" @click="convert">Cha-ching!</button>
            </div>
            <div v-if="errors.length" class="error text-red-600">
                Oh no, there were errors!
            </div>
            <coinage v-if="coins !== undefined" :coins="coins" />
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
            errors: [],
            coins: undefined
        }
    },
    methods: {
        convert() {
            axios.get('/api/convert/USD?value=' + this.total)
            .then(response => this.coins = response.data)
            .catch(error => console.error(error))
        }
    }
}
</script>

<style scoped>

</style>
