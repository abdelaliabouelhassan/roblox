<template>
    <section
        id="hero"
        class="pt-[4rem] md:pt-[5.5rem] pb-9 lg:pb-0 flex relative z-[0] mx-auto"
    >
        <div class="w-full h-full absolute top-0 left-0 z-0 flex">
            <img
                class="w-full object-cover object-[10%] lg:object-center opacity-[7%] z-0"
                src="/images/bg-hero.jpg"
                alt=""
                srcset=""
            />
            <div
                class="w-full h-full aspect-square absolute -top-[70%] rounded-full left-0 bg-orange/40 blur-[9rem] lg:blur-[10rem] z-0"
            ></div>
            <div
                class="h-[4rem] blur-lg lg:h-[28rem] w-full absolute bottom-0 left-0 translate-y-1/2 bg-dark-blue lg:blur-xl z-0"
            ></div>
        </div>
        <div
            class="z-[1] max-w-[1220px] mx-auto px-6 flex flex-col items-center text-center gap-6"
        >
            <div
                class="w-40 h-40 bg-yellow ring ring-white rounded-full overflow-hidden"
            >
                <img
                    src="https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg?auto=compress&cs=tinysrgb&w=600"
                    alt=""
                    class="w-full h-full object-cover"
                />
            </div>
            <span class="md:text-5xl text-2xl text-white font-bold"
                >Awokein</span
            >
            <h1
                class="text-yellow font-bold text-center text-4xl max-w-[25rem] mx-auto md:text-7xl md:max-w-[51.75rem]"
            >
                Programmer & Student Software Engineer
            </h1>

            <p class="max-w-[700px] font-medium text-gray-200">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia
                itaque eaque sapiente exercitationem culpa saepe aliquid
                dignissimos est, ea sint nesciunt. Accusamus quisquam sed
                repellendus delectus. Debitis velit illo aspernatur!
            </p>

            <dl
                class="flex items-end justify-center flex-wrap gap-8 p-4 mx-auto sm:grid-cols-3 xl:grid-cols-6 sm:p-8"
            >
                <div
                    class="flex flex-col items-center text-center gap-4 justify-center"
                >
                    <dd class="text-gray-400 text-xl font-semibold">
                        Contributed
                    </dd>
                    <dt class="mb-2 text-5xl font-extrabold">
                        {{ formatNumber(visits) }}+
                    </dt>
                    <dd class="text-gray-400 font-semibold text-xl">
                        Play Sessions
                    </dd>
                </div>
                <div
                    class="flex flex-col items-center gap-4 justify-center text-center"
                >
                    <dt class="mb-2 text-5xl font-extrabold">
                        {{ formatNumber(playing) }}+
                    </dt>
                    <dd class="text-gray-400 font-semibold text-xl">
                        Current Players
                    </dd>
                </div>
                <div
                    class="flex flex-col items-center gap-4 justify-center text-center"
                >
                    <dt class="mb-2 text-5xl font-extrabold">
                        {{ formatNumber(favoritedCount) }}+
                    </dt>
                    <dd class="text-gray-400 font-semibold text-xl">
                        Favorited
                    </dd>
                </div>
            </dl>

            <div class="w- flex items-center gap-6">
                <a
                    href="https://reddit.com/u/awokein"
                    class="fab fa-reddit-alien hover:text-yellow duration-300 text-4xl"
                ></a>
                <a
                    href="https://roblox.com/users/207355228"
                    class="hover:text-yellow duration-300"
                    ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="36"
                        height="36"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill="currentColor"
                            d="m13.383 14.341l-3.726-.958l.959-3.726l3.726.959l-.96 3.726zM4.913 0L0 19.088L19.088 24L24 4.912L4.912 0z"
                        /></svg
                ></a>
                <a
                    href="https://steamcommunity.com/id/Awokein/"
                    class="fab fa-steam hover:text-yellow duration-300 text-4xl"
                ></a>
                <a
                    href="https://youtube.com/awokein"
                    class="fab fa-youtube hover:text-yellow duration-300 text-4xl"
                ></a>
            </div>
            <div class="pt-4">
                <a href="mailto:ollie@awokein.com">
                    <button
                        class="rounded-md border border-yellow text-white py-4 px-10 text-center text-sm transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-yellow hover:border-slate-800 focus:text-white active:text-white disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button"
                    >
                        Contact Me
                    </button>
                </a>
            </div>
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

const playing = ref(0);
const visits = ref(0);
const favoritedCount = ref(0);
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
