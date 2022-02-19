<template>
  <div>
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h4>Projects</h4>
          </div>
          <div class="col-2">
            <div class="text-right">
              <button type="button" class="btn btn-sm btn-success" @click.prevent="addProject">Add project</button>
            </div>
          </div>
        </div>
      </div>
      <table class="card-table table">
        <thead>
        <tr>
          <th>Project Name</th>
          <th>Entries</th>
          <th>Total time</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="project in projects">
          <td v-text="project.name"></td>
          <td v-text="project.entries.length"></td>
          <td>
            <!-- TODO: Calculate total hours spent -->
            0
          </td>
          <td class="text-right">
            <button type="button" class="btn btn-sm btn-dark" @click.prevent="editProject(project)">Edit</button>
            <button type="button" class="btn btn-sm btn-danger" @click.prevent="deleteProject(project)">Delete</button>
            <a :href="`/projects/${project.id}`" class="btn btn-sm btn-secondary">Details</a>
          </td>
        </tr>
        </tbody>
      </table>
    </div>

    <!-- Modals -->
    <upsert-project ref="upsert"/>
  </div>
</template>

<script>
import UpsertProject from './UpsertProject';

export default {
  name: 'Projects',
  components: {
    UpsertProject,
  },
  props: ['projects'],
  methods: {
    addProject () {
      this.$refs.upsert.open({
        id: null,
        name: '',
      });
    },
    editProject (project) {
      this.$refs.upsert.open(project);
    },
    deleteProject (project) {
      if(confirm(`Are you sure you want to delete ${project.name}?`)){
        axios.delete(`/projects/${project.id}`).then(response => {
          window.location.reload();
        }).catch(error => {
          // MUST-FIX: Proper error handling
          throw new Error(error);
        })
      }
    }
  }
};
</script>
