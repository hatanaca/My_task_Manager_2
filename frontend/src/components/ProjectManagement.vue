<template>
	<div>
		<h2>Project Management</h2>
		<form @submit.prevent="createProject">
			<input v-model="newProject.name" placeholder="Project Name" required />
			<textarea v-model="newProject.description" placeholder="Project Description"></textarea>
			<button type="submit">Create Project</button>
		</form>
		<ul>
			<li v-for"project in project" :key="project">
				<strong>{{ project.name }}</strong>: {{ project.description }}
			</li>
		</ul>
	</div>
</template>


