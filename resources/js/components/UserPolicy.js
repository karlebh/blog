

export default class UserPolicy{

	static create(user)
	{
		return true;
	}

	static view(user, post)
	{
		return true;
	}

	static edit(user, post)
	{
		return user.id === post.user_id;
		// || user.role === admin

	}

	static delete(user, post)
	{
		return user.id === post.user_id;  

		// || user.role === admin
	}

	static update(user, post)
	{
		return user.id === post.user_id;
		// || user.role === admin

	}
}