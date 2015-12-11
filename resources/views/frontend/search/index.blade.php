@extends('frontend.layouts.master')

@section('content')
  @forelse($articleResults as $article)
    <?php
        echo $article['title'];
    ?>
    <br>
  @empty
    <br>No articles to show<br>
  @endforelse

  @forelse($userResults as $user)
    <?php
        echo $user['first_name'];
    ?>
    <br>
  @empty
    <br>No users to show<br>
  @endforelse

  @forelse($publicationResults as $publication)
    <?php
        echo $publication['title'];
    ?>
    <br>
  @empty
    <br>No publications to show<br>
  @endforelse

  @forelse($discussionResults as $discussion)
    <?php
        echo $discussion['title'];
    ?>
    <br>
  @empty
    <br>No discussions to show<br>
  @endforelse

  @forelse($resourceResults as $resource)
    <?php
        echo $resource['name'];
    ?>
    <br>
  @empty
    <br>No resources to show<br>
  @endforelse

@stop
