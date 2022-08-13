<template>
    <div class="">
        <h1 class="mt-5 text-capitalize">{{ page.title }}</h1>
        <small class="text-muted clearfix">Created At: <b>{{ page.created_at }}</b></small>
        <div class="d-flex justify-content-between">
            <small class="text-muted clearfix">slug: <b>{{ page.slug }}</b></small>
            <router-link :to="{ name: 'pages' }" class="btn btn-warning item-center">
                Back to list
            </router-link>
        </div>
        <hr class="text-muted" />
        <div v-html="page.content"> </div>
    </div>
</template>

<script>
import axios from 'axios';
import { API_URL } from '../../utils';

export default {
    name: "NestedView",
    mounted: function () {
        let lastSlug = window.location.pathname.split('/').filter(e => e !== '').pop()
        axios.get(`${API_URL}/pages/${lastSlug}`)
            .then(res => {
                res = res.data
                if (res.success) this.page = res.data
                else {
                    console.log('res.message::', res.message);
                    if (res?.message) alert("Error: " + res.message)
                }
            })
            .catch(e => {
                alert("Error Found: Open console to see logs")
                console.log('ERROR::', e.response.error.message);
            })
    },

    data() {
        return {
            page: {
                id: null,
                title: null,
                slug: null,
                parent_id: null,
                content: null,
                created_at: null,
            }
        }
    }
}
</script>

<style>
</style>