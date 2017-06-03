class Errors {
	constructor() {
		this.errors = {};
	}

	get(field) {
		if (this.errors[field]) {
			return this.errors[field][0];
		}
	}

	has(field) {
		return this.errors.hasOwnProperty(field);
	}

	any() {
		// return Object.keys(this.errors).length > 0;
		return false;
	}

	record(errors) {
		this.errors = errors;
	}

	clear(field) {
		if (this.errors[field]) {
			delete this.errors[field][0];
		}
	}
}

export default Errors;