<template>
    <div class="d-flex mt-5 justify-content-between">
        <h4 class="">All Tables</h4>

        <router-link :to="{ name: 'create' }" class="btn btn-primary right">
            Add New Page
        </router-link>
    </div>
    <br />
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="page in pages" :key="page.id">
                <td>{{ page.id }}</td>
                <td>{{ page.title }}</td>
                <td>{{ page.slug }}</td>
                <td>{{ page.created_at || '-' }}</td>
                <td>{{ page.updated_at || '-' }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{ name: 'edit', params: { id: page.id } }" class="btn btn-primary">
                            Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deletePage(page.id)">
                            Delete
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    data() {
        return {
            pages: []
        }
    },

    created() {
        axios
            .get('http://localhost:8000/api/pages')
            .then(response => {
                this.pages = response.data.data;
                console.log('this.pages::', this.pages);
            });
        // this.getPages()
    },
    methods: {
        // getPages() {

        // }
    }
};
import axios from 'axios';
</script>

<style>
</style>
