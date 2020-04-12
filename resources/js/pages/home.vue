<template>
  <div>
    <todos></todos>
  </div>
</template>

<script>
import Todos from '../components/Todos.vue'

export default {
  middleware: 'auth',
  components: {
    'todos': Todos
  },
  data() {
    return {
      todos: [
        {
          'id': 1,
          'title': 'todo 1',
          'done' : false
        },
        {
          'id': 2,
          'title': 'todo 2',
          'done' : false
        },
      ],
      newTodo: ''
    }
  }  
}
</script>
