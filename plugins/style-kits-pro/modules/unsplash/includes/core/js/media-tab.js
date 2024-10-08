const { __ } = wp.i18n;

'undefined' != typeof jQuery &&
	!(function($) {
		if ('undefined' != typeof wp && wp.media) {
			var Select = wp.media.view.MediaFrame.Select,
				l = (wp.media.controller.Library, wp.media.view.l10n),
				Frame = wp.media.view.Frame,
				n = null;

			(wp.media.view.AnalogUnsplash_Browser = Frame.extend({
				tagName: 'div',
				className: 'attachments-browser analogunsplash-browser',
				id: 'ang-unsplash-photos',
				initialize: function() {
					_.defaults(this.options, {
						filters: !1,
						filteraccount: !1,
						search: !1,
						date: !1,
						display: !1,
						sidebar: !1,
						toolbar: !1,
						AttachmentView: wp.media.view.Attachment.Library
					}),
						this.createHackyReactEmbedView();
				},
				createHackyReactEmbedView: function() {
					this.editPageLoaded &&
						this.reactLoaded &&
						this.$el.length > 0 &&
						((n = this),
						window.ReactDOM.render(
							window.angUnsplash,
							this.$el.get(0)
						));
				},
				editPageLoaded: function() {
					if (window.adminpage === 'post.php') {
						return true;
					} else {
						return false;
					}
				},
				reactLoaded: function() {
					if (
						window.React !== undefined &&
						window.ReactDOM !== undefined
					) {
						return true;
					} else {
						return false;
					}
				}
			})),
				(Select.prototype.bindHandlers = function() {
					this.on('router:create:browse', this.createRouter, this),
						this.on(
							'router:render:browse',
							this.browseRouter,
							this
						),
						this.on(
							'content:create:browse',
							this.browseContent,
							this
						),
						this.on(
							'content:create:analogunsplash',
							this.analogunsplash,
							this
						),
						this.on(
							'content:render:upload',
							this.uploadContent,
							this
						),
						this.on(
							'toolbar:create:select',
							this.createSelectToolbar,
							this
						);
				}),
				(Select.prototype.browseRouter = function(e) {
					var Select = {};
					(Select.upload = {
						text: l.uploadFilesTitle,
						priority: 20
					}),
						(Select.browse = {
							text: l.mediaLibraryTitle,
							priority: 40
						}),
						(Select.analogunsplash = {
							text: __('Unsplash Images', 'ang-pro'),
							priority: 60
						}),
						e.set(Select),
						setTimeout(function() {
							$(
								'.media-frame .media-router a.media-menu-item:last-child'
							).addClass('media-menu-item-elements');
						}, 400);
				}),
				(Select.prototype.analogunsplash = function(e) {
					var Select = this.state();
					e.view = new wp.media.view.AnalogUnsplash_Browser({
						controller: this,
						model: Select,
						AttachmentView: Select.get('AttachmentView')
					});
				});
				$( document ).on('click', '.media-menu-item', function(){
					const angActiveTab = $( '#menu-item-analogunsplash' ).hasClass( 'active' );
					if ( angActiveTab ) {
						$( '.media-toolbar-primary .media-button' ).attr('disabled', true);
					}
				});
		}
	}(jQuery));
