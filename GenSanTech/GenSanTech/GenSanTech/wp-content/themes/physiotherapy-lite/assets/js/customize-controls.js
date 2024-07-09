( function( api ) {

	// Extends our custom "physiotherapy-lite" section.
	api.sectionConstructor['physiotherapy-lite'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );