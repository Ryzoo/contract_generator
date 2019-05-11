'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

exports.default = makeAlgoliaPlacesWidget;

var _places = require('../places.js');

var _places2 = _interopRequireDefault(_places);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _objectWithoutProperties(obj, keys) { var target = {}; for (var i in obj) { if (keys.indexOf(i) >= 0) continue; if (!Object.prototype.hasOwnProperty.call(obj, i)) continue; target[i] = obj[i]; } return target; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
 * The underlying structure for the Algolia Places instantsearch widget.
 */
var AlgoliaPlacesWidget = function () {
  function AlgoliaPlacesWidget(_ref) {
    var defaultPosition = _ref.defaultPosition,
        placesOptions = _objectWithoutProperties(_ref, ['defaultPosition']);

    _classCallCheck(this, AlgoliaPlacesWidget);

    if (defaultPosition instanceof Array && defaultPosition.length === 2) {
      this.defaultPosition = defaultPosition.join(',');
    }

    this.placesOptions = placesOptions;
    this.placesAutocomplete = (0, _places2.default)(this.placesOptions);

    this.state = {};
  }

  _createClass(AlgoliaPlacesWidget, [{
    key: 'init',
    value: function init(_ref2) {
      var _this = this;

      var helper = _ref2.helper;

      helper.setQueryParameter('insideBoundingBox').setQueryParameter('aroundLatLng', this.state.position || this.defaultPosition);

      this.placesAutocomplete.on('change', function (opts) {
        var _opts$suggestion = opts.suggestion,
            _opts$suggestion$latl = _opts$suggestion.latlng,
            lat = _opts$suggestion$latl.lat,
            lng = _opts$suggestion$latl.lng,
            value = _opts$suggestion.value;


        _this.state.position = lat + ',' + lng;
        _this.state.query = value;

        helper.setQueryParameter('insideBoundingBox').setQueryParameter('aroundLatLng', _this.state.position).search();
      });

      this.placesAutocomplete.on('clear', function () {
        _this.state.position = undefined;
        _this.state.query = undefined;

        helper.setQueryParameter('insideBoundingBox').setQueryParameter('aroundLatLng', _this.defaultPosition).search();
      });
    }
  }, {
    key: 'getWidgetSearchParameters',
    value: function getWidgetSearchParameters(searchParameters, _ref3) {
      var uiState = _ref3.uiState;

      if (!uiState.places) {
        this.placesAutocomplete.setVal('');
        return searchParameters;
      }

      var _uiState$places = uiState.places,
          query = _uiState$places.query,
          position = _uiState$places.position;


      this.state = uiState.places;
      this.placesAutocomplete.setVal(query || '');

      return searchParameters.setQueryParameter('insideBoundingBox').setQueryParameter('aroundLatLng', position);
    }
  }, {
    key: 'getWidgetState',
    value: function getWidgetState(uiState, _ref4) {
      var searchParameters = _ref4.searchParameters;

      if (uiState.places && this.state.query === uiState.places.query && searchParameters.aroundLatLng === uiState.places.position) {
        return uiState;
      }

      if (searchParameters.aroundLatLng === undefined && this.state.query === undefined) {
        var newUiState = Object.assign({}, uiState);
        delete newUiState.places;
        return newUiState;
      }

      return _extends({}, uiState, {
        places: {
          query: this.state.query,
          position: searchParameters.aroundLatLng
        }
      });
    }
  }]);

  return AlgoliaPlacesWidget;
}();

/**
 * Creates a new instance of the Algolia Places widget. This widget
 * sets the geolocation value for the search based on the selected
 * result in the Algolia Places autocomplete. If the input is cleared,
 * the position is result to the default position.
 * @function
 * @param {object} opts configuration object
 * @param {number[]} opts.defaultPosition=[0,0] default position as an array of the form [lat, lng]
 * @returns {Widget} the algolia places widget
 */


function makeAlgoliaPlacesWidget(opts) {
  return new AlgoliaPlacesWidget(opts);
}