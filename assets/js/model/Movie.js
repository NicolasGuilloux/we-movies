export class Movie {
    id;
    title;
    overview;
    poster_path;
    adult;
    release_date;
    genre_ids;
    original_title;
    original_language;
    backdrop_path;
    popularity;
    vote_count;
    vote_average;
    video;

    constructor(data) {
        data && Object.assign(this, data);
    }
}
