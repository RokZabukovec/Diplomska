<template>
    <div class="rounded-md bg-white shadow">
        <ul class="divide-y divide-gray-200" role="list">
            <li
                v-for="project in data"
                :key="project.id"
                :class="{
                    'bg-indigo-600 text-white':
                        projectSelected != null &&
                        project.id === projectSelected.id,
                }"
                class="px-6 py-4 cursor-pointer rounded"
                @click="selectProject(project)"
            >
                <Transition
                    enter="transition-opacity duration-75"
                    enterFrom="opacity-0"
                    enterTo="opacity-100"
                    leave="transition-opacity duration-150"
                    leaveFrom="opacity-100"
                    leaveTo="opacity-0"
                >
                    <div class="flex justify-between align-middle">
                        <div>
                            <h2
                                class="flex justify-between font-bold leading-7 sm:truncate sm:tracking-tight"
                            >
                                {{ project.name }}
                            </h2>
                            <p class="text-sm">{{ project.description }}</p>
                        </div>
                        <ProjectEditMenu></ProjectEditMenu>
                    </div>
                </Transition>
            </li>
        </ul>
    </div>
</template>

<script setup>
// props
import store from "../../Store/store";
import { computed, onMounted } from "vue";
import ProjectEditMenu from "./ProjectEditMenu.vue";

const props = defineProps(["data"]);

const projects = computed(() => store.state.general.projects);
const projectSelected = computed(() => store.state.general.selectedProject);

onMounted(() => {
    try {
        const defaultProject = projects.value[0];
        selectProject(defaultProject);
    } catch (error) {
        console.log(error);
    }
});

function selectProject(project) {
    store.commit("general/selectProject", project);
}
</script>
