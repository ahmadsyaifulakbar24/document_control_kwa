<template>
	<div>
        <template v-if="user.user_level_id == 100">
            <router-link :to="{ name: 'project.create' }">
                <button class="btn btn-primary mb-3">Buat Project</button>
            </router-link>
        </template>
        <div v-if="pagination.last_page > 1" class="float-right row">
            <div class="mr-3"> Data ke {{ projects.meta.from }} - {{ projects.meta.to }} dari {{ projects.meta.total }} data </div>
            <Pagination :last_page="pagination.last_page" :pagination="pagination" @paginate="showAllProject()"/>
        </div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="text-truncate">Nama Projek</th>
					<th class="text-truncate">Keterangan</th>
					<th class="text-truncate">Tanggal dibuat</th>
					<th v-if="user.user_level_id == 100" class="text-truncate text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="project in projects.data" :key="project.id">
					<td class="text-truncate">
                        <router-link :to ="{ name:'subProject.listSubProject', params: { projectID: project.id } }">
                            {{ project.name }}
                        </router-link>
                    </td>
					<td class="text-truncate">{{ project.keterangan }}</td>
					<td class="text-truncate">{{ project.created_at }}</td>
                    <td v-if="user.user_level_id == 100" class="text-truncate">
                        <div class="d-flex">
                            <div class="text-info">
                                <router-link :to="{ name: 'project.edit', params: { projectID: project.id } }">
                                    <i class="mdi mdi-pencil"><span>Edit</span></i>
                                </router-link>
                            </div>
                            <delete-project :projectID="project.id"/>
                        </div>
                    </td>
				</tr>
			</tbody>
		</table>
	</div>

</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import DeleteProject from "./DeleteProject";
import Pagination from '@/components/Pagination.vue'

export default {
    components: {
        DeleteProject,
        Pagination
    },
    data() {
        return {
            projects: {
                data:[],
                meta:{},
            },
            pagination: {
                last_page: '',
                current_page: 1
            }
        }
    }, 
    computed: {
        ...mapGetters({
            user: 'auth/user'
        })
    },
    mounted() {
        this.showAllProject()
    },

    methods: {
        async showAllProject() {
            await axios.get(`document_flow/project/get?page=${this.pagination.current_page}`)
            .then((response) => {
                this.projects.data = response.data.data
                this.projects.meta = response.data.meta
                this.pagination.last_page = response.data.meta.last_page
            }).catch((error) => {
                console.log(error)
            })
        }
    }
};
</script>