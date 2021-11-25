<?php declare(strict_types=1);

namespace App\Tests\Api;

use App\Api\TMDB\Method\GetGenres;
use App\Api\TMDB\Method\GetMovie;
use App\Api\TMDB\Method\GetMoviesByGenre;
use App\Api\TMDB\Method\GetMovieSearch;
use App\Api\TMDB\Method\GetVideosByMovie;
use App\Api\TMDB\Model\DiscoverResponse;
use App\Api\TMDB\Model\Genre;
use App\Api\TMDB\Model\Movie;
use App\Api\TMDB\Model\MovieDetails;
use App\Api\TMDB\Model\Video;
use App\Tests\Resources\Spy\HttpClientSpy;
use App\Tests\Resources\TestCase\WebTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * @covers \App\Api\TMDB\ApiClient
 * @covers \App\Api\TMDB\Method\AbstractMethod
 * @covers \App\Api\TMDB\Method\GetGenres
 * @covers \App\Api\TMDB\Method\GetMovie
 * @covers \App\Api\TMDB\Method\GetMoviesByGenre
 * @covers \App\Api\TMDB\Method\GetMovieSearch
 * @covers \App\Api\TMDB\Method\GetVideosByMovie
 */
final class TmdbApiTest extends WebTestCase
{
    public function testHttpClientSpy(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientInterface::class);
        self::assertInstanceOf(HttpClientSpy::class, $spy);

        $spy->stubRequest('GET', 'https://test.fr/test', 'Test');
        $response = $spy->request('GET', 'https://test.fr/test');

        self::assertInstanceOf(MockResponse::class, $response);
    }

    public function testGetGenres(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientSpy::class);
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/genre/movie/list', 'get_genres.json');

        /** @var GetGenres $apiMethod */
        $apiMethod = $this->getService(GetGenres::class);
        $genres = $apiMethod();

        self::assertContainsOnlyInstancesOf(Genre::class, $genres);
        self::assertCount(19, $genres);
    }

    public function testGetMovie(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientSpy::class);
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/movie/20', 'get_movie.json');

        /** @var GetMovie $apiMethod */
        $apiMethod = $this->getService(GetMovie::class);
        $movieDetails = $apiMethod(20);

        self::assertInstanceOf(MovieDetails::class, $movieDetails);
    }

    public function testGetMoviesByGenre(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientSpy::class);
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/discover/movie', 'get_movies_by_genre.json');
        $genre = new Genre();
        $genre->id = 20;
        $genre->name = 'test';

        /** @var GetMoviesByGenre $apiMethod */
        $apiMethod = $this->getService(GetMoviesByGenre::class);
        $response = $apiMethod($genre);

        self::assertInstanceOf(DiscoverResponse::class, $response);
    }

    public function testGetMovieSearch(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientSpy::class);
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/search/movie', 'get_movie_search.json');
        $genre = new Genre();
        $genre->id = 20;
        $genre->name = 'test';

        /** @var GetMovieSearch $apiMethod */
        $apiMethod = $this->getService(GetMovieSearch::class);
        $response = $apiMethod('test');

        self::assertInstanceOf(DiscoverResponse::class, $response);
    }

    public function testGetVideosByMovie(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientSpy::class);
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/movie/10/videos', 'get_videos_by_movie.json');
        $movie = new Movie();
        $movie->id = 10;

        /** @var GetVideosByMovie $apiMethod */
        $apiMethod = $this->getService(GetVideosByMovie::class);
        $response = $apiMethod($movie);

        self::assertContainsOnlyInstancesOf(Video::class, $response);
    }
}
