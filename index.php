<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Data Design</title>
	</head>
	<body>
		<h1>Data Design</h1>
		<div>
			<h2>Persona</h2>
			<p><strong>Name: </strong>Julie</p>
			<p><strong>Age: </strong>27</p>
			<p><strong>Profession: </strong>Student</p>
			<p><strong>Technology: </strong>Uses a MacBook Pro (macOS High Sierra 10.13.4) and an iPhone X (iOS 11.3)</p>
			<p><strong>Attitudes and Behaviors: </strong>Julie is a full time student that enjoys watching movies on her free time. She is extremely organized and likes keeping everything on track. Including her social medias.</p>
			<p><strong>Frustrations and Needs: </strong>Julie is tired of “no meaning” social medias and wants to find one where she can share her movie passion.</p>
			<p><strong>Goals: </strong>Julie wants to keep tracking all the movies that she has watched in case she decides to watch some again or even suggest to a friend what to see or not. She needs a social media that will make that possible.</p>
		</div>
		<div>
			<h2>User Story</h2>
			<p>As a user, Julie wants to rate movies on Filmow.</p>
		</div>
		<img src = "images/data-design-page.JPG">
		<div>
			<h2>Use Case/Interaction Flow</h2>
			<p>Precondition: Julie is logged in her account.</p>
			<ul>
				<li>Julie is on her profile page</li>
				<li>She types a movie name in the search bar and clicks ok</li>
				<li>Site shows the possible results for her search</li>
				<li>Julie clicks on the right movie link</li>
				<li>Site shows the movie page</li>
				<li>Julie clicks on the star button to rate the movie</li>
				<li>Site saves her rating and show it to her</li>
			</ul>
			<div>
				<h2>Conceptual Model</h2>
				<p>Numerous profiles can rate various movies multiple times (m-to-n)</p>
			</div>
			<h3>Entities &amp; Attributes</h3>
			<ul>
				<li>profile (Julie must login to her account in order to rate the movies)</li>
				<ul>
					<li>profileId (unique information and primary key)</li>
					<li>profileName</li>
					<li>profileEmail (unique information)</li>
					<li>profileActivationToken (unique information)</li>
					<li>profileHash</li>
				</ul>
				<li>movie (the content that Julie wants to rate)</li>
				<ul>
					<li>movieId (unique information and primary key)</li>
					<li>movieName</li>
					<li>movieDirector</li>
					<li>movieGenre</li>
					<li>movieLength</li>
				</ul>
				<li>ratings (Julie’s interaction with movies)</li>
				<ul>
					<li>ratingsProfileId (foreign key)</li>
					<li>ratingsMovieId (foreign key)</li>
					<li>ratingsDate</li>
				</ul>
			</ul>
				<br>
				<h2>Entity Relationship Diagram (ERD)</h2>
		<img src = "images/data-design-erd.SVG">
	</body>
</html>