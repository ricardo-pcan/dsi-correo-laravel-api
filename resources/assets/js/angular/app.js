var app = angular.module( 'dsi_coreo', ['angular-oauth2'] )
.config([ 'OAuthProvider', function( OAuthProvider)]{
    OAuthProvider.configure({
        baseUrl: 'http://localhost:8000',
        clientId: '1',
        clientSecret: 'dsi-correo' // optional
    });
});
