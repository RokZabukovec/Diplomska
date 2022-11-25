<template>
    <div class="overflow-hidden bg-white shadow sm:rounded-md">
      <ul role="list" class="divide-y divide-gray-200">
        <li v-for="command in commands" :key="command.id">
          <a href="#" class="block hover:bg-gray-50">
            <div class="px-4 py-4 sm:px-6">
              <div class="flex items-center justify-between">
                <p class="truncate text-sm font-medium text-indigo-600" v-html="colorizeCommand(command.command)"></p>
              </div>
              <div class="mt-2 sm:flex sm:justify-between">
                <div class="sm:flex">
                  <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                    {{ command.description }}
                  </p>
                </div>
              </div>
              <div class="flex flex-shrink-0 mt-3">
                  <p class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800" v-for="tag in command.tags" :key="tag.id">
                    {{ tag.name.en }}
                </p>
                </div>
            </div>
          </a>
        </li>
      </ul>
      <TailwindPagination
        :data="pagination"
        @pagination-change-page="getResults"
    />
    </div>
  </template>

  <script setup>
    import SlideOverNewCommand from "./SlideOverNewCommand.vue";
    import { TailwindPagination } from 'laravel-vue-pagination';

    import { computed, onMounted } from "vue";
    import { useStore } from "vuex";

    let store = useStore();
    let commands = computed(() => store.state.commands.commands);
    let pagination = computed(() => store.state.commands.pagination);
    let projectId = computed(() => store.state.general.selectedProject.id);

    const isFile = (text) => /[^\\/]+\.[^\\/]+$/.test(text);
    const isOperator = (text) =>
    /^(\|{1,2})|(<{1,2})|(&{1,2})|(>{1,2})|{|\[|\]|\}/.test(text);
    const isQuoted = (text) => /^(".+")|('.+')$/.test(text);

    let colorizeCommand = (command) => {
    const cursorNode = document.createElement("span");
    cursorNode.className = "stylized-commands";

    const originalTextContent = command.split(" ");

    originalTextContent.forEach((text, index) => {
        const textNode = document.createElement("span");
        textNode.textContent = `${text} `;

        // If first word or first after a pipe, highlight as command
        if (index === 0 || isOperator(originalTextContent[index - 1])) {
            textNode.className = "command";
            textNode.className = "text-stone-800";
        }

        if (text.startsWith("--") || text.startsWith("-")) {
            textNode.className = "flag";
            textNode.className = "text-blue-500";
        }

        if (isOperator(text)) {
            textNode.className = "operator";
            textNode.className = "text-orange-600";
        }

        if (isFile(text)) {
            textNode.className = "file";
            textNode.className = "text-green-500";
        }

        if (isQuoted(text)) {
            textNode.className = "quoted";
            textNode.className = "text-grey-500";
        }
        return cursorNode.appendChild(textNode);
    });
    return cursorNode.outerHTML;
    };

    const getResults = (projectId, page)=> {
        console.log('getResults', projectId, page)
        store.commit("commands/getCommands", projectId, page);
    }

    onMounted(() => {
        getResults(projectId, 1);
    });

  </script>
