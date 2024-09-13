<template>
    <section
        class="z-10 relative max-w-[1220px] mx-auto px-6 pb-10 pt-20 md:pt-40 space-y-10"
    >
        <h1 class="text-4xl md:text-6xl font-bold">My Work</h1>

        <div
            class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10"
        >
            <a
                v-for="(item, index, key) in data"
                :key="key"
                :href="
                    'https://www.roblox.com/games/' +
                    item.rootPlaceId +
                    '/Blade-Ball'
                "
                target="_blank"
            >
                <div
                    class="w-full rounded-3xl hover:border-yellow duration-200 cursor-pointer shadow hover:shadow-xl group bg-[#1F2224] overflow-hidden p-2 z-[1] bg-white/5 border-white/10 border-2 backdrop-blur-xl"
                >
                    <div class="w-full">
                        <img
                            :src="item.image"
                            class="w-full h-full object-cover rounded-2xl"
                            alt=""
                        />
                    </div>

                    <div class="w-full pt-4 px-2 pb-2 text-center">
                        <span
                            class="text-2xl text-white group-hover:text-yellow duration-200 font-bold"
                            >{{ item.name }}</span
                        >

                        <div class="pt-5 flex flex-col items-start gap-4">
                            <span class="text-lg text-gray-100"
                                >Contributed :
                                <span class="font-bold text-white">{{
                                    formatNumber(item.visits)
                                }}</span>
                            </span>
                            <span class="text-lg text-gray-100"
                                >Current Players :
                                <span class="font-bold text-white">{{
                                    formatNumber(item.playing)
                                }}</span>
                            </span>
                            <span class="text-lg text-gray-100"
                                >Favorited
                                <span class="font-bold text-white">{{
                                    formatNumber(item.favoritedCount)
                                }}</span>
                            </span>
                        </div>
                    </div>

                    <div
                        class="w-full px-2 pt-4 gap-2 flex items-center flex-wrap"
                    >
                        <div
                            v-for="(tag, tagindex, tagkey) in item.tags"
                            :key="tagkey"
                            :class="getColorByIndex(tagindex)"
                            class="mb-4 rounded-full ring-white/40 ring-1 cyan py-0.5 bg-opacity-30 px-2.5 border border-transparent text-xs text-white transition-all shadow-sm text-center"
                        >
                            {{ tag }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </section>
</template>
<script setup>
import { onMounted, ref } from "vue";

const props = defineProps({
    data: {
        type: Array,
        default: [],
    },
});

const tagColors = ref(["cyan", "fuchsia", "gray", "bg-yellow"]);

const playing = ref(0);
const visits = ref(0);
const favoritedCount = ref(0);

const getColorByIndex = (index) => {
    // Check if the index is within the bounds of tagColors
    if (index < tagColors.value.length) {
        return tagColors.value[index];
    }

    // If the index is out of bounds, return a random color from tagColors
    const randomIndex = Math.floor(Math.random() * tagColors.value.length);
    return tagColors.value[randomIndex];
};

const formatNumber = (number) => {
    if (number >= 1_000_000_000) {
        return (number / 1_000_000_000).toFixed(1) + "B"; // Billions
    } else if (number >= 1_000_000) {
        return (number / 1_000_000).toFixed(1) + "M"; // Millions
    } else if (number >= 1_000) {
        return (number / 1_000).toFixed(1) + "K"; // Thousands
    } else {
        return number; // Less than 1K
    }
};

onMounted(() => {
    props.data.forEach((element) => {
        playing.value += element.playing;
        visits.value += element.visits;
        favoritedCount.value += element.favoritedCount;
    });
});

console.log(props.data);
</script>

<style scoped>
.cyan {
    @apply bg-cyan-600;
}

.fuchsia {
    @apply bg-fuchsia-500;
}

.gray {
    @apply bg-gray-500;
}
</style>
