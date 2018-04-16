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
			<p><strong>Name: </strong>Jully</p>
			<p><strong>Age: </strong>27</p>
			<p><strong>Profession: </strong>Student</p>
			<p><strong>Technology: </strong>Uses a MacBook Pro (macOS High Sierra 10.13.4) and an iPhone X (iOS 11.3)</p>
			<p><strong>Attitudes and Behaviors: </strong>Jully is a full time student that enjoys watching movies on her free time. She is extremely organized and likes keeping everything on track. Including her social medias.</p>
			<p><strong>Frustrations and Needs: </strong>Jully is tired of “no meaning” social medias and wants to find one where she can share her movie passion.</p>
			<p><strong>Goals: </strong>Jully wants to keep tracking all the movies that she has watched in case she decides to watch some again or even suggest to a friend what to see or not. She needs a social media that will make that possible.</p>
		</div>
		<div>
			<h2>User Story</h2>
			<p>As a user, Jully wants to rate movies on Filmow.</p>
		</div>
		<img src = "data-design-page.JPG">
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
				<p>Numerous profiles can rate various movies multiple times (m-to-n)</p>
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
					<li>ratingProfileId (foreign key)</li>
					<li>ratingMovieId (foreign key)</li>
				</ul>
			</ul>
				<br>
				<h2>Entity Relationship Diagram (ERD)</h2>
		<img src = "data-design-erd.SVG">
	</body>
</html>