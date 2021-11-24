export class Genre {
    id;
    name;

    constructor(data) {
        data && Object.assign(this, data);
    }
}
