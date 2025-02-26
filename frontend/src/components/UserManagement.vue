<template>
	<div>
		<h2>User Management</h2>
		<table>
			<thead>
				<tr>
					<th>Name</th><th>Email</th><th>Role</th><th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="user in users" :key="user.id">
					<td>{{ user.name }}</td>
					<td>{{ user.email }}</td>
					<td>
						<select v-model="user.role" @change="updateUser(user)">
							<option value="admin">Admin</option>
							<option value="user">User </option>
						</select>
					</td>
					<td>
						<button @click="deleteUser(user.id)">Delete</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
