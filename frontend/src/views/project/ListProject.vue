<template>
	<div>
        <router-link :to="{ name: 'project.create' }">
            <div class="mb-3">
                <button class="btn btn-primary">Buat Project</button>
            </div>
        </router-link>
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="text-truncate">Nama Projek</th>
					<th class="text-truncate">Keterangan</th>
					<th class="text-truncate">Tanggal dibuat</th>
					<th class="text-truncate text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="project in projects.data" :key="project.id">
					<td class="text-truncate">{{ project.name }}</td>
					<td class="text-truncate">{{ project.keterangan }}</td>
					<td class="text-truncate">{{ project.created_at }}</td>
                    <td class="text-truncate">
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
import DeleteProject from "./DeleteProject";
export default {
    components: {
        DeleteProject
    },
    data() {
        return {
            projects: [],
        }
    }, 
    mounted() {
        this.showAllProject()
    },

    methods: {
        async showAllProject() {
            await axios.get('document_flow/project/get')
            .then((response) => {
                this.projects = response.data
            }).catch((error) => {
                console.log(error)
            })
        }
    }
};
</script>