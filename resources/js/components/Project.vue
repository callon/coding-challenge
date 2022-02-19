<template>
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-10">
          <h4 v-text="project.name"></h4>
        </div>
        <div class="col-2">
          <div class="text-right">
            <button v-show="running" type="button" class="btn btn-sm btn-danger" @click.prevent="stopTimer">Stop
            </button>
            <button v-show="!running" type="button" class="btn btn-sm btn-success" @click.prevent="startTimer">Start
            </button>
          </div>
        </div>
      </div>
    </div>
    <table class="card-table table">
      <thead>
      <tr>
        <th>Start date</th>
        <th>End date</th>
        <th>Time spent</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="entry in project.entries">
        <td v-text="entry.start"></td>
        <td v-text="entry.end"></td>
        <td>
          <!-- TODO: Calculate time spent -->
          0 hours
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'Project',
  props: {
    project: Object,
  },
  computed: {
    running () {
      return !!this.project.entries.find(entry => {
        return !entry.end;
      });
    }
  },
  methods: {
    startTimer () {
      axios.post(`/projects/${this.project.id}/entries/start`).then((response) => {
        window.location.reload();
      });
    },
    stopTimer () {
      axios.post(`/projects/${this.project.id}/entries/stop`).then((response) => {
        window.location.reload();
      });
    }
  }
};
</script>
