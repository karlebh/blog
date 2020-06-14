import UserPolicy from './UserPolicy'


export default class Gate
{
	constructor(user)
	{
		this.user = user;

		this.policies = {
			userPolicy : UserPolicy
		}

	},

	

}