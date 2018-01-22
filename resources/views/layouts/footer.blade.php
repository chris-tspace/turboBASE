  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      <small>Contact: <a href="mailto:{{ env('APP_CONTACT_EMAIL') }}?Subject={{ env('APP_NAME') }} {{ env('APP_VERSION') }}">{{ env('APP_CONTACT_NAME') }}</a></small>
    </div>
    <!-- Default to the left -->
    {{ env('APP_NAME') }} {{ config('app.version') }} - <small><strong>Copyright &copy; 2018</strong> - <a href="{{ env('APP_CONTACT_URL') }}"> {{ env('APP_CONTACT_COMPANY') }}</a></small>
  </footer>
