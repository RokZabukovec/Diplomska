<template>
    <div class="markdown-editor mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create document</h5>
                            <hr />
                            <select
                                aria-label="Project name"
                                class="form-select"
                            >
                                <option selected>Select project</option>
                                <option
                                    v-for="project in projects"
                                    :key="project.id"
                                    :value="project.id"
                                >
                                    {{ project.name }}
                                </option>
                            </select>
                            <br />
                            <div class="form-check float-end">
                                <label
                                    class="form-check-label"
                                    for="flexCheckDefault"
                                >
                                    {{ editorSwitch }}
                                    <input
                                        id="flexCheckDefault"
                                        v-model="preview"
                                        class="form-check-input"
                                        type="checkbox"
                                        value=""
                                    />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9">
                    <div v-if="preview" class="card document-preview__wrapper">
                        <div
                            v-highlight
                            class="card-body markdown-body"
                            v-html="compiledMarkdown"
                        ></div>
                    </div>
                    <textarea
                        v-else
                        class="markdown-editor__textarea"
                    ></textarea>
                    <div class="page-actions">
                        <button
                            class="btn btn-warning btn-page-save"
                            @click="save()"
                        ></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import marked from "marked";

export default {
    name: "MarkdownPageEditor",
    data() {
        return {
            projects: [],
            preview: false,
            editorSwitch: "Preview",
        };
    },
    computed: {
        compiledMarkdown: function () {
            if (this.page.body !== undefined) {
                return marked(this.page.body, { sanitize: true });
            }
            return this.page.body;
        },
    },
    mounted() {
        this.getPage();
    },
    methods: {
        async getPage() {},
        save() {},
    },
};
</script>
