<script setup>
defineProps({
    links: {
        type: Array,
        default: [],
    },
});
</script>

<template>
    <div class="d-flex">
        <aside class="sidebar">
            <h3>Castillet</h3>
            <ul>
                <template v-for="link in links" :key="link">
                    <li
                       
                        :class="{ active: route().current(link.base_route) }"
                    >
                    <a 
                          
                          
                           :href="route(link.route)"
                        >
                        {{ link.label }}
                        </a>
                    </li>
                </template>

                
            </ul>
        </aside>
        <div class="content w-100">
            <slot name="slot" />
        </div>
    </div>
</template>

<style scoped>
.blue {
    color: rgb(103, 103, 243) !important;
}
</style>
