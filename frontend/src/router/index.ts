import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
//Router é biblioteca que controla as rotas das paginas, createRouter cria um objeto que recebe as rotas e opções
import TaskList from '../components/TaskList.vue';
import TaskDetail from '../components/TaskDetail.vue';
import UserManagement from '../components/UserManagement.vue';
import ProjectManagement from '../components/ProjectManagement.vue';

const routes: Array<RouteRecordRaw> = [
	{ path: '/', name: 'TaskList', component: TaskList },
	{ path: '/', name: 'TaskDetail', component: TaskDetail, props: true },
	{ path: '/', name: 'UserManagement', component: UserManagement },
	{ path: '/', name: 'ProjectManagement', component: ProjectManagement }
];

const router = createRouter({
	history: createWebHistory(),
	routes,
});

export default router;
