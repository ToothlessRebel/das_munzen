<template>
    <div class="coinage w-1/2 m-auto">
        <div class="coin grid grid-cols-2 gap-4" v-for="coin in Object.entries(coins)" :key="coin[0]">
            <div class="inline-block text-right">
                {{ coin[0].replaceAll('-', ' ').replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase()) }}:
            </div>
            <div class="inline-block text-left">
                {{ new Intl.NumberFormat('en-US', {maximumSignificantDigits: 2}).format(coin[1]) }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Coinage",
    props: {
        coins: {
            type: Object,
            default: function () {
                return {};
            },
        },
    },
}
</script>

<style scoped>

</style>
