export default function ( { $axios, redirect } ) {
    $axios.onError( error => {
        const code = parseInt( error.response && error.response.status );
        if ( code === 400 ) {
            redirect( '/pages/404' );
        }

        if(code == 406){
            redirect('/pages/coming-soon')
        }
    } );
}
