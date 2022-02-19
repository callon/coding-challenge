<template>
  <div class="modal" tabindex="-1" role="dialog" ref="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            {{ this.project.id ? `Edit ${name}` : 'Add new project' }}
          </h5>
          <button type="button" class="close" @click.prevent="closeModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div v-if="errors" class="alert alert-danger">
            <div v-for="(v, k) in errors" :key="k">
              <p v-for="error in v" :key="error">
                {{ error }}
              </p>
            </div>
          </div>
          <div class="form-group">
            <label for="project_name">Project name</label>
            <input type="text" name="project_name" id="project_name" class="form-control" v-model="projectName" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click.prevent="closeModal">Cancel</button>
          <button type="button" class="btn btn-success" @click.prevent="submit">Save project</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    project: {},
    projectName: '',
    errors: null,
  }),
  computed: {
    name() {
      if (this.project) {
        return this.project.name;
      }
      return '';
    }
  },
  methods: {
    open(project = {}) {
      if(project.id){
        this.project = project
        this.projectName = this.project.name
      }

      $(this.$refs.modal).modal('show');
    },
    closeModal() {
      $(this.$refs.modal).modal('hide');
      this.projectName = '';
    },
    submit() {
      const projectId = this.project.id ?? false;


      axios({
        method: projectId ? 'patch' : 'post',
        url: projectId ? `/projects/${projectId}` : '/projects',
        data: {
          name: this.projectName,
        }
      }).then((response) => {
        window.location.reload();
      }).catch((error) => {
        // MUST-FIX: DO PROPER ERROR HANDLING
        throw new Error(error);
      });
    }
  }
}
</script>
