<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Data Design</title>
	</head>
	<body>
		<h1>Data Design</h1>
		<div><h2>Persona</h2>
			<p>Jully is an almost 30 years old woman 👵🏻 who loves movies. Because of her OCD, she enjoys rating the movies that she watched. One way that she finds to do so is by using the website https://filmow.com/ with her MacBook (macOS High Sierra 10.13.4) and on her iPhone X (iOS 11.3). As a Millennial, she is very confident with technology.</p>
		</div>
		<div>
			<h2>User Story</h2>
			<p>As a user, Jully wants to rate movies on Filmow.</p>
		</div>
		<img src = "data%20design%20website.JPG">
		<div>
			<h2>Use Case/Interaction Flow</h2>
			<p>Precondition: Jully is logged in her account.</p>
			<ul>
				<li>Jully is on her profile page</li>
				<li>She types a movie name in the search bar and clicks ok</li>
				<li>Site shows the possible results for her search</li>
				<li>Jully clicks on the right movie link</li>
				<li>Site shows the movie page</li>
				<li>Jully clicks on the star button to rate the movie</li>
				<li>Site saves her rating and show it to her</li>
			</ul>
			<div>
				<h2>Conceptual Model</h2>
				<p>Numerous users can rate various movies multiple times (m-to-n)</p>
			</div>
			<h3>Entities &amp; Attributes</h3>
			<ul>
				<li>profile (Jully must login to her account in order to rate the movies)</li>
				<ul>
					<li>profileId (primary key)</li>
					<li>profileName</li>
					<li>profileEmail (unique information)</li>
					<li>profileActivationToken</li>
					<li>profileAtHandle (unique information)</li>
					<li>profileHash</li>
				</ul>
				<li>movie (the content that Jully wants to rate)</li>
				<ul>
					<li>movieId (unique information and primary key)</li>
					<li>movieName</li>
					<li>movieDirector</li>
					<li>movieGenre</li>
					<li>movieLength</li>
				</ul>
				<li>ratings (Jully’s interaction with movies)</li>
				<ul>
					<li>ratingsId (primary key)</li>
					<li>ratingProfileId (foreign key)</li>
					<li>ratingMovieId (foreign key)</li>
				</ul>
			</ul>
				<br>
				<h2>Entity Relationship Diagram (ERD)</h2>
		<img src = "data%20design%20erd.JPG">
	</body>
</html>